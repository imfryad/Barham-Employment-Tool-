document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            
            const fullName = document.getElementById('full-name').value.trim();
            const preciseLocation = document.getElementById('precise-location').value.trim();
            const phoneNumber = document.getElementById('phone-number').value.trim();
            const birthday = document.getElementById('birthday').value.trim();
            
            if (!fullName || !preciseLocation || !phoneNumber || !birthday) {
                alert("تکایە هەموو خانەکان پڕ بکەوە.");
                return;
            }
            
            alert("داواکاریەکت وەرگیرا، سوپاس بۆ ئەوەی کاتت پێمان بەخشی");
        });
    }

    const fileInput = document.getElementById('cv-upload');

    fileInput.addEventListener('change', function() {
        const file = fileInput.files[0];
        if (file) {
            const allowedTypes = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];
            const maxSize = 5 * 1024 * 1024; // 5 MB

            if (!allowedTypes.includes(file.type)) {
                alert('Please upload a valid file type: PDF, DOCX, JPG, JPEG, PNG.');
                fileInput.value = ''; // Clear the input
                return;
            }

            if (file.size > maxSize) {
                alert('File size exceeds 5 MB. Please upload a smaller file.');
                fileInput.value = ''; // Clear the input
                return;
            }
        }
    });
});
