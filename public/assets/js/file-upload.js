console.log('file-upload.js loaded');

var fileInput = document.getElementById('id_document');
var fileUploadDisplay = document.getElementById('fileUploadDisplay');
var selectedFileName = document.getElementById('selectedFileName');
var selectedFileSize = document.getElementById('selectedFileSize');
var removeFileBtn = document.getElementById('removeFileBtn');

console.log('Elements found:', {
    fileInput: !!fileInput,
    fileUploadDisplay: !!fileUploadDisplay,
    removeFileBtn: !!removeFileBtn
});

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    var k = 1024;
    var sizes = ['Bytes', 'KB', 'MB'];
    var i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

if (fileInput) {
    fileInput.addEventListener('change', function() {
        console.log('File changed, count:', this.files.length);
        if (this.files.length > 0) {
            var file = this.files[0];
            console.log('File selected:', file.name, 'Size:', file.size);
            
            selectedFileName.textContent = file.name;
            selectedFileSize.textContent = formatFileSize(file.size);
            fileUploadDisplay.style.display = 'flex';
            fileUploadDisplay.style.visibility = 'visible';
            
            console.log('Display box shown. Current display:', window.getComputedStyle(fileUploadDisplay).display);
        }
    });
}

if (removeFileBtn) {
    console.log('Setting up remove button listener');
    removeFileBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Remove clicked');
        
        fileInput.value = '';
        fileUploadDisplay.style.display = 'none';
    });
} else {
    console.log('Remove button not found!');
}
