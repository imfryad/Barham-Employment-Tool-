// Load saved preferences from localStorage
document.addEventListener('DOMContentLoaded', function() {
    var savedState = JSON.parse(localStorage.getItem('columnPreferences')) || {};

    document.querySelectorAll('.toggle-column').forEach(function(checkbox) {
        var column = checkbox.getAttribute('data-column');
        var isChecked = savedState[column] !== false; // Default to true if not saved
        checkbox.checked = isChecked;

        var cells = document.querySelectorAll('table tr td:nth-child(' + column + '), table tr th:nth-child(' + column + ')');
        cells.forEach(function(cell) {
            cell.style.display = isChecked ? '' : 'none';
        });
    });
});

// Save preferences to localStorage
function savePreferences() {
    var state = {};
    document.querySelectorAll('.toggle-column').forEach(function(checkbox) {
        state[checkbox.getAttribute('data-column')] = checkbox.checked;
    });
    localStorage.setItem('columnPreferences', JSON.stringify(state));
}

document.querySelectorAll('.toggle-column').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var column = this.getAttribute('data-column');
        var cells = document.querySelectorAll('table tr td:nth-child(' + column + '), table tr th:nth-child(' + column + ')');
        cells.forEach(function(cell) {
            cell.style.display = checkbox.checked ? '' : 'none';
        });
        savePreferences(); // Save state on change
    });
});

document.getElementById('checkAll').addEventListener('click', function() {
    document.querySelectorAll('.toggle-column').forEach(function(checkbox) {
        checkbox.checked = true;
        var column = checkbox.getAttribute('data-column');
        var cells = document.querySelectorAll('table tr td:nth-child(' + column + '), table tr th:nth-child(' + column + ')');
        cells.forEach(function(cell) {
            cell.style.display = '';
        });
    });
    savePreferences(); // Save state after changing all
});

document.getElementById('uncheckAll').addEventListener('click', function() {
    document.querySelectorAll('.toggle-column').forEach(function(checkbox) {
        checkbox.checked = false;
        var column = checkbox.getAttribute('data-column');
        var cells = document.querySelectorAll('table tr td:nth-child(' + column + '), table tr th:nth-child(' + column + ')');
        cells.forEach(function(cell) {
            cell.style.display = 'none';
        });
    });
    savePreferences(); // Save state after changing all
});

// Handle Collapse/Expand of the checkboxes
document.getElementById('toggleCheckboxes').addEventListener('click', function() {
    var checkboxContainer = document.getElementById('checkboxContainer');
    var isHidden = checkboxContainer.style.display === '';

    checkboxContainer.style.display = isHidden ? 'none' : '';
    this.textContent = isHidden ? 'پشاندانی چێک بۆکسەکان' : 'شاردنەوەی چێک بۆکسەکان';
});
