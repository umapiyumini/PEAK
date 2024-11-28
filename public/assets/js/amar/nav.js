document.addEventListener('DOMContentLoaded', function() {
    const itemsWithDropdown = document.querySelectorAll('.has-dropdown');
    let activeDropdown = null;

    function closeDropdown(item) {
        item.classList.remove('active');
        const dropdown = item.querySelector('.dropdown');
        dropdown.style.opacity = '0';
        dropdown.style.transform = 'translateY(-10px)';
        setTimeout(() => {
            dropdown.classList.remove('active');
            dropdown.style.height = '0';
        }, 200);
    }

    function openDropdown(item) {
        if (activeDropdown && activeDropdown !== item) {
            closeDropdown(activeDropdown);
        }
        item.classList.add('active');
        const dropdown = item.querySelector('.dropdown');
        dropdown.classList.add('active');
        dropdown.style.height = dropdown.scrollHeight + 'px';
        setTimeout(() => {
            dropdown.style.opacity = '1';
            dropdown.style.transform = 'translateY(0)';
        }, 50);
        activeDropdown = item;
    }

    itemsWithDropdown.forEach(item => {
        const link = item.querySelector('.nav-link');
        
        link.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            if (item.classList.contains('active')) {
                closeDropdown(item);
                activeDropdown = null;
            } else {
                openDropdown(item);
            }
        });
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.has-dropdown') && activeDropdown) {
            closeDropdown(activeDropdown);
            activeDropdown = null;
        }
    });
});x``