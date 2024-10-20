$(document).ready(function() {
    // Get current URL path
    var currentPath = window.location.pathname.split("/").pop();

    // Iterate through all nav-link elements
    $('nav ul.nav-sidebar a.nav-link').each(function() {
        var href = $(this).attr('href');

        // Compare href with current path
        if (href === currentPath) {
            // Add active class to the matching nav-link
            $(this).addClass('active');

            // If the nav-link is inside a treeview, expand the parent treeview
            $(this).closest('.nav-item.has-treeview').addClass('menu-open');
        }
    });
});

// menu dropdown

