# AdminLTE Dashboard UI Plugin For AppGini (Bootstrap 5 Version)

[![HomePage](https://payherokenya.com/appginilte/FireShot%20Capture%20041%20-%20Northwind%20-%20Homepage%20-%20localhost.png)](https://payherokenya.com/appginilte/FireShot%20Capture%20041%20-%20Northwind%20-%20Homepage%20-%20localhost.png)

# Check Out The Pro Version, With added features, functionality and customizations
[CHECKOUT THE PRO VERSION DOCUMENTATION](https://portals.docsie.io/ronthedev/ronthedev-docs/ronthedev-docs-platinum/appginilte-pro/deployment_9gnlh6Jl5RYLgSnjV/)

#
## Donate!
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/donate/?hosted_button_id=LK3UXEMV785XA)

## Introduction
This is an **easy to use and install** admin dashboard UI for AppGini generated applications.
It gives your AppGini applications a modern look and feel, built on top of:
*   **Bootstrap 5.3.2**
*   **AdminLTE 3.2.0**

[APPGINI FORUM TOPIC THREAD (Original)](https://forums.appgini.com/phpbb/viewtopic.php?f=12&t=4792/) (Note: This thread may refer to older versions of the theme.)

## Core Technologies Used
*   **Bootstrap 5.3.2**: The theme now utilizes the latest Bootstrap 5 framework.
*   **AdminLTE 3.2.0**: Provides the core layout and components.
*   **jQuery**: Included locally (`appginilte/plugins/jquery/jquery.min.js`) as it's a dependency for AdminLTE 3.2.0.
*   **Font Awesome 6.5.1**: Icons are provided locally via `appginilte/assets/fontawesome-free/`.

No `npm install` or separate package manager steps are required to use the theme itself, as essential assets are included locally.

## Installation and Integration (AppGini 25.12+)

1.  **Generate AppGini Application**: Start by generating your application using AppGini version 25.12 or newer.
2.  **Copy Theme Folder**: Download the AppginiLTE theme and copy the `appginilte` folder into the root directory of your generated AppGini application.
3.  **Run Installation Script**:
    *   Log in to your AppGini application as an administrator.
    *   Navigate to `your-app-url/appginilte_install.php` in your web browser (e.g., `http://localhost/your_app/appginilte_install.php`).
    *   This script will patch necessary AppGini files to activate the AppginiLTE theme.
    [![InstallSuccess](https://payherokenya.com/appginilte/FireShot%20Capture%20046%20-%20Northwind%20-%20localhost.png)](https://payherokenya.com/appginilte/FireShot%20Capture%20046%20-%20Northwind%20-%20localhost.png)
4.  **Review AppGini Display Settings (Recommended)**:
    *   In the AppGini admin area, review the "Display Settings" for your tables. While this theme attempts to provide compatibility, ensuring field types and Bootstrap classes selected in AppGini align with Bootstrap 5 can improve appearance (e.g., for specific form controls if AppGini allows class overrides there).

**Note on Re-generating AppGini Application**: If you re-generate your AppGini application files, the AppginiLTE theme integration might be overwritten. To restore it, simply re-run the installation script (`appginilte_install.php`) as described in step 3.

## Key Changes in This Version

*   **Bootstrap Update**: Theme updated from Bootstrap 4 to **Bootstrap 5.3.2**.
*   **AdminLTE Version**: Utilizes **AdminLTE 3.2.0**, which is compatible with Bootstrap 5.
*   **Asset Reorganization**: Core theme assets (Bootstrap CSS/JS, Font Awesome CSS/webfonts, ChartJS) have been moved into the `appginilte/assets/` directory for better organization.
*   **CSS Class Mapping**: Many Bootstrap 4 utility classes have been updated to their Bootstrap 5 equivalents throughout the theme files. Key examples relevant to AppGini context include:
    *   **Spacing**: `ml-*`/`mr-*` are now `ms-*`/`me-*`. `pl-*`/`pr-*` are now `ps-*`/`pe-*`.
    *   **Text Alignment**: `text-left`/`text-right` are now `text-start`/`text-end`.
    *   **Floats**: `float-left`/`float-right` are now `float-start`/`float-end`.
    *   **Alerts**: For dismissible alerts, Bootstrap 5 uses `data-bs-dismiss="alert"` and the close button class `btn-close` (updated in theme files like `appginilte_install.php`).
    *   **Dropdowns**: Uses `data-bs-toggle="dropdown"` instead of `data-toggle="dropdown"`. `dropdown-menu-right` is now `dropdown-menu-end`.
    *   **Tabs**: Uses `data-bs-toggle="pill"` instead of `data-toggle="pill"`.
*   **JavaScript**:
    *   jQuery is still included (`appginilte/plugins/jquery/jquery.min.js`) and required by AdminLTE 3.2.0.
    *   Some theme-specific jQuery usage (e.g., in `appginilte_settings.php` for dynamic form interactions) has been refactored to vanilla JavaScript.
*   **Font Awesome**: Updated to **Font Awesome 6.5.1** (CSS and webfonts) and included locally.
*   **PHP 8 Compatibility**: Theme PHP files have been reviewed for basic PHP 8 compatibility (e.g., array initialization, JSON handling robustness).
*   **Custom CSS**: A dedicated `appginilte/assets/css/custom.css` file has been introduced for easier user customizations and includes compatibility styles.

## Customizations

*   **Theme Settings**: Access customization options by clicking the user icon in the top-right navbar, then selecting "AppginiLTE Settings". This allows you to configure icons for table groups, table card colors, and visibility of elements on the homepage and navigation menu.
    [![Customization](https://payherokenya.com/appginilte/FireShot%20Capture%20045%20-%20Northwind%20-%20localhost.png)](https://payherokenya.com/appginilte/FireShot%20Capture%20045%20-%20Northwind%20-%20localhost.png)
*   **Adding Custom Code to Dashboard**:
    *   The theme installation script (`appginilte_install.php`) creates placeholder files in `appginilte/hooks/views/` (e.g., `Admins_Top.php`, `Admins_Bottom.php` based on your user groups).
    *   You can add custom HTML, PHP, and JavaScript to these files to display content above or below the main table group cards on the dashboard.
*   **Further AdminLTE Customization**: For deeper structural or component changes, refer to the [AdminLTE Documentation](https://adminlte.io/docs/3.2/).

## Blockers and Important Considerations for Users

Upgrading to this Bootstrap 5 version of AppginiLTE requires attention to the following, especially when used with existing AppGini projects:

1.  **AppGini DML Templates (Visual Styling)**:
    *   AppGini's default Data Manipulation Language (DML) templates (which generate the forms and detail views) may still output some Bootstrap 4 classes.
    *   **`form-group`**: This class (used for spacing around form elements) has no default styling in Bootstrap 5. The theme includes a compatibility rule in `appginilte/assets/css/custom.css` (`.form-group { margin-bottom: 1rem; }`) to provide basic spacing.
    *   **`btn-default`**: This button class is also deprecated. The theme provides compatibility styling in `custom.css` to mimic Bootstrap 4's default button.
    *   **`btn-xs`**: This class for extra-small buttons has been removed in Bootstrap 5. If AppGini DML generates this, buttons will appear unstyled or larger. Consider using `btn-sm` instead.
    *   **For optimal Bootstrap 5 styling and behavior, users may need to customize their AppGini DML templates** (found in `hooks/tablename-dv.php`, `hooks/tablename-tv.php`, and AppGini's internal template files if making more global changes) to use Bootstrap 5 classes (e.g., `mb-3` instead of `form-group`, `btn btn-secondary` instead of `btn btn-default`).

2.  **JavaScript in AppGini Hooks (CRITICAL for Functionality)**:
    *   Any custom JavaScript in your AppGini hook files (e.g., `hooks/products-hooks.php`, `hooks/__global.php`) that interacts with Bootstrap components using **Bootstrap 4 jQuery plugin syntax WILL BREAK**.
    *   Examples of broken syntax: `$('#myModal').modal('show')`, `$('.tooltip').tooltip()`, `$('#myTabs a').tab('show')`.
    *   This JavaScript **MUST be updated** to use Bootstrap 5's vanilla JavaScript API.
    *   Examples of Bootstrap 5 API:
        *   Modal: `var myModalEl = document.getElementById('myModal'); var modal = new bootstrap.Modal(myModalEl); modal.show();`
        *   Tooltip: `var tooltipTriggerEl = document.getElementById('myTooltip'); var tooltip = new bootstrap.Tooltip(tooltipTriggerEl);`
        *   Tab: `var triggerTabEl = document.querySelector('#myTabs a[href="#profile"]'); bootstrap.Tab.getInstance(triggerTabEl).show();` or `var tab = new bootstrap.Tab(triggerTabEl); tab.show();`

3.  **jQuery UI Dependencies**:
    *   This theme **does not include jQuery UI**. If your AppGini project or custom hooks rely on jQuery UI components (e.g., specific date pickers, sortable interactions not provided by AppGini's core or AdminLTE), these features will cease to function.
    *   You will need to manually include jQuery UI in your project or, preferably, find Bootstrap 5 or vanilla JavaScript alternatives for these components.

4.  **Third-Party JavaScript Plugins**:
    *   Plugins included with AdminLTE 3.2.0 are generally expected to be compatible.
    *   If you have integrated other custom third-party JavaScript plugins that relied on Bootstrap 4 specific features or older jQuery behavior, they might require review and potential updates or replacement.

## Screenshots And Demo (Illustrative - Based on Original Theme)

*The following screenshots are from the original version of the theme and may not fully reflect all Bootstrap 5 styling updates but give a general idea of the AdminLTE layout.*

[![Homepage](https://payherokenya.com/appginilte/FireShot%20Capture%20041%20-%20Northwind%20-%20Homepage%20-%20localhost.png)](https://payherokenya.com/appginilte/FireShot%20Capture%20041%20-%20Northwind%20-%20Homepage%20-%20localhost.png)
------------
[![Detailview](https://payherokenya.com/appginilte/FireShot%20Capture%20042%20-%20Northwind%20-%20localhost.png)](https://payherokenya.com/appginilte/FireShot%20Capture%20042%20-%20Northwind%20-%20localhost.png)
------------
[![Addnew](https://payherokenya.com/appginilte/FireShot%20Capture%20043%20-%20Northwind%20-%20localhost.png)](https://payherokenya.com/appginilte/FireShot%20Capture%20043%20-%20Northwind%20-%20localhost.png)
------------
[![CustmizeSettings](https://payherokenya.com/appginilte/FireShot%20Capture%20044%20-%20Northwind%20-%20localhost.png)](https://payherokenya.com/appginilte/FireShot%20Capture%20044%20-%20Northwind%20-%20localhost.png)

---
This updated README provides users with essential information about the theme's migration to Bootstrap 5, installation, key changes, and critical considerations for integrating it with their AppGini projects.The `README.md` has been updated with the new information.

I've tried to:
*   Clearly state the new Bootstrap 5 and updated Font Awesome versions.
*   Update installation instructions.
*   List the key changes made during the refactoring.
*   Provide a comprehensive "Blockers and Important Considerations" section, emphasizing the critical need for users to update their custom JavaScript in hooks and be aware of potential AppGini DML template discrepancies with Bootstrap 5.
*   Retain the Pro version and donation links.
*   Adjusted the "Customizations" section slightly to reflect where custom dashboard view files are now created (`appginilte/hooks/views/`).
*   Clarified that the screenshots are illustrative from an older version.

This README should give users a good starting point for using the updated theme and understanding the migration implications.
