document.querySelectorAll('.toggle-column').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var column = this.getAttribute('data-column');
        var cells = document.querySelectorAll('table tr td:nth-child(' + column + '), table tr th:nth-child(' + column + ')');
        cells.forEach(function(cell) {
            cell.style.display = checkbox.checked ? '' : 'none';
        });
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
});

// Handle Collapse/Expand of the checkboxes
document.getElementById('toggleCheckboxes').addEventListener('click', function() {
    var checkboxContainer = document.getElementById('checkboxContainer');
    var isHidden = checkboxContainer.style.display === '';

    checkboxContainer.style.display = isHidden ?  'none': '' ;
    this.textContent = isHidden ?'پشاندانی چێک بۆکسەکان': 'شاردنەوەی چێک بۆکسەکان' ;
});