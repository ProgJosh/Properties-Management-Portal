<?php

namespace App\Http\Controllers;

use App\Models\PaymentReminder;
use App\Services\ReminderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    private ReminderService $reminderService;

    public function __construct(ReminderService $reminderService)
    {
        $this->reminderService = $reminderService;
    }

    /**
     * Get all reminders for current user
     */
    public function index()
    {
        $user = Auth::user();
        $reminders = PaymentReminder::where('user_id', $user->id)
            ->orderBy('due_date', 'desc')
            ->paginate(15);

        return view('reminders.index', compact('reminders'));
    }

    /**
     * Get pending reminders
     */
    public function pending()
    {
        $user = Auth::user();
        $reminders = PaymentReminder::where('user_id', $user->id)
            ->pending()
            ->orderBy('due_date', 'asc')
            ->get();

        return view('reminders.pending', compact('reminders'));
    }

    /**
     * Get overdue reminders
     */
    public function overdue()
    {
        $user = Auth::user();
        $reminders = PaymentReminder::where('user_id', $user->id)
            ->overdue()
            ->orderBy('due_date', 'desc')
            ->get();

        return view('reminders.overdue', compact('reminders'));
    }

    /**
     * View single reminder details
     */
    public function show(PaymentReminder $reminder)
    {
        $this->authorize('view', $reminder);
        $notificationLogs = $reminder->notificationLogs()->latest()->get();

        return view('reminders.show', compact('reminder', 'notificationLogs'));
    }

    /**
     * Acknowledge a reminder
     */
    public function acknowledge(PaymentReminder $reminder)
    {
        $this->authorize('update', $reminder);

        try {
            $reminder->acknowledge();

            return response()->json([
                'success' => true,
                'message' => 'Reminder acknowledged successfully',
                'status' => $reminder->status,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error acknowledging reminder: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get reminder statistics
     */
    public function statistics()
    {
        $user = Auth::user();
        $stats = [
            'total' => PaymentReminder::where('user_id', $user->id)->count(),
            'pending' => PaymentReminder::where('user_id', $user->id)->pending()->count(),
            'sent' => PaymentReminder::where('user_id', $user->id)->where('status', 'sent')->count(),
            'acknowledged' => PaymentReminder::where('user_id', $user->id)->where('status', 'acknowledged')->count(),
            'overdue' => PaymentReminder::where('user_id', $user->id)->overdue()->count(),
            'failed_notifications' => PaymentReminder::where('user_id', $user->id)
                ->where('status', 'failed')
                ->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Admin: Dashboard showing all reminders
     */
    public function adminDashboard()
    {
        $this->authorize('viewAny', PaymentReminder::class);

        $stats = $this->reminderService->getReminderStats();
        $recentReminders = PaymentReminder::with(['user', 'property', 'booking'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $overdueReminders = PaymentReminder::overdue()->count();
        $pendingReminders = PaymentReminder::pending()->count();

        return view('admin.reminders.dashboard', compact(
            'stats',
            'recentReminders',
            'overdueReminders',
            'pendingReminders'
        ));
    }

    /**
     * Admin: View all reminders
     */
    public function adminIndex(Request $request)
    {
        $this->authorize('viewAny', PaymentReminder::class);

        $query = PaymentReminder::with(['user', 'property', 'booking']);

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by reminder type
        if ($request->type) {
            $query->where('reminder_type', $request->type);
        }

        // Filter by user/property
        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            })
            ->orWhereHas('property', function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%");
            });
        }

        $reminders = $query->orderBy('due_date', 'desc')->paginate(20);

        return view('admin.reminders.index', compact('reminders'));
    }

    /**
     * Admin: Resend reminder notifications
     */
    public function resendNotifications(PaymentReminder $reminder)
    {
        $this->authorize('update', $reminder);

        try {
            $this->reminderService->sendReminder($reminder);

            return response()->json([
                'success' => true,
                'message' => 'Reminder notifications resent successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error resending notifications: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Admin: Delete a reminder
     */
    public function destroy(PaymentReminder $reminder)
    {
        $this->authorize('delete', $reminder);

        try {
            $reminder->delete();

            return response()->json([
                'success' => true,
                'message' => 'Reminder deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting reminder: ' . $e->getMessage(),
            ], 500);
        }
    }
}
