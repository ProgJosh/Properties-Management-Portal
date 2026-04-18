<div class="inquiry-chatbot" data-chatbot-root>
    <button type="button" class="inquiry-chatbot__toggle" data-chatbot-open>
        <i class="fa fa-comments"></i>
        <span>Inquiry Bot</span>
    </button>

    <div class="inquiry-chatbot__panel" data-chatbot-panel hidden>
        <div class="inquiry-chatbot__header">
            <div>
                <strong>Inquiry Assistant</strong>
                <div class="small">Ask about bookings, rent, listings, payments, or landlord messages.</div>
            </div>
            <button type="button" class="inquiry-chatbot__close" data-chatbot-close>
                <i class="fa fa-times"></i>
            </button>
        </div>

        <div class="inquiry-chatbot__messages" data-chatbot-messages>
            <div class="inquiry-chatbot__bubble inquiry-chatbot__bubble--bot">
                Hello! I can help with bookings, listings, payments, and how to contact a landlord.
            </div>
        </div>

        <form class="inquiry-chatbot__form" data-chatbot-form>
            <input type="text" class="common-input common-input--sm flex-grow-1" name="message"
                placeholder="Ask your question..." autocomplete="off" required>
            <button type="submit" class="btn btn-main btn-sm">Send</button>
        </form>
    </div>
</div>

<style>
    .inquiry-chatbot {
        position: fixed;
        right: 24px;
        bottom: 110px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .inquiry-chatbot__toggle {
        border: 0;
        border-radius: 999px;
        padding: 12px 18px;
        background: linear-gradient(135deg, #ff9a1f, #ff5f1f);
        color: #fff;
        box-shadow: 0 12px 24px rgba(255, 111, 31, 0.28);
        display: flex;
        align-items: center;
        gap: 10px;
        position: fixed;
        right: 24px;
        bottom: 110px;
        z-index: 10000;
        white-space: nowrap;
    }

    .inquiry-chatbot__panel {
        position: fixed;
        right: 24px;
        bottom: 178px;
        width: min(360px, calc(100vw - 32px));
        max-height: min(560px, calc(100vh - 120px));
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 24px 60px rgba(17, 24, 39, 0.18);
        overflow: hidden;
        z-index: 10001;
    }

    .inquiry-chatbot__panel[hidden] {
        display: none !important;
    }

    .inquiry-chatbot__header {
        background: #17131a;
        color: #fff;
        padding: 18px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .inquiry-chatbot__close {
        background: transparent;
        border: 0;
        color: #fff;
    }

    .inquiry-chatbot__messages {
        max-height: 320px;
        overflow-y: auto;
        padding: 16px;
        background: #fff8f2;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .inquiry-chatbot__bubble {
        max-width: 85%;
        padding: 12px 14px;
        border-radius: 16px;
        line-height: 1.5;
        font-size: 14px;
    }

    .inquiry-chatbot__bubble--bot {
        align-self: flex-start;
        background: #fff;
        color: #1f2937;
    }

    .inquiry-chatbot__bubble--user {
        align-self: flex-end;
        background: #ff8d1a;
        color: #fff;
    }

    .inquiry-chatbot__form {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 10px;
        padding: 14px;
        background: #fff;
        border-top: 1px solid #f1f1f1;
        align-items: stretch;
    }

    .inquiry-chatbot__form input {
        min-width: 0;
    }

    .inquiry-chatbot__form .btn {
        min-width: 96px;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        line-height: 1.1;
    }

    @media (max-width: 575.98px) {
        .inquiry-chatbot {
            right: 12px;
            bottom: 96px;
        }

        .inquiry-chatbot__toggle {
            right: 12px;
            bottom: 96px;
            width: auto;
            justify-content: center;
        }

        .inquiry-chatbot__panel {
            right: 12px;
            left: 12px;
            bottom: 168px;
            width: auto;
            max-height: min(70vh, calc(100vh - 110px));
            border-radius: 18px;
        }

        .inquiry-chatbot__form {
            flex-direction: column;
            grid-template-columns: 1fr;
        }

        .inquiry-chatbot__form .btn {
            width: 100%;
        }
    }
</style>

<script>
    (function () {
        const initChatbot = () => {
            const root = document.querySelector('[data-chatbot-root]');
            if (!root || root.dataset.initialized === 'true') return;

            root.dataset.initialized = 'true';

            const panel = root.querySelector('[data-chatbot-panel]');
            const openBtn = root.querySelector('[data-chatbot-open]');
            const closeBtn = root.querySelector('[data-chatbot-close]');
            const form = root.querySelector('[data-chatbot-form]');
            const messages = root.querySelector('[data-chatbot-messages]');

            const appendMessage = (text, type) => {
                const bubble = document.createElement('div');
                bubble.className = 'inquiry-chatbot__bubble inquiry-chatbot__bubble--' + type;
                bubble.textContent = text;
                messages.appendChild(bubble);
                messages.scrollTop = messages.scrollHeight;
            };

            openBtn.addEventListener('click', () => {
                panel.hidden = false;
                openBtn.hidden = true;
            });

            closeBtn.addEventListener('click', () => {
                panel.hidden = true;
                openBtn.hidden = false;
            });

            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const formData = new FormData(form);
                const text = (formData.get('message') || '').toString().trim();
                if (!text) return;

                appendMessage(text, 'user');
                form.reset();

                try {
                    const response = await fetch('{{ route('chatbot.reply') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: new URLSearchParams({
                            message: text,
                        }),
                    });

                    const data = await response.json();
                    appendMessage(data.answer || 'I could not process that question right now.', 'bot');
                } catch (error) {
                    appendMessage('Something went wrong while sending your question. Please try again.', 'bot');
                }
            });
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initChatbot);
        } else {
            initChatbot();
        }
    })();
</script>
