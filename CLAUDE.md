# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

Binary Modifications is a WordPress plugin that provides shared customizations for the Binary Playground family of websites. It implements a multi-site architecture where global modifications apply to all sites, while site-specific modifications are loaded conditionally based on the domain.

## Architecture

### Plugin Entry Point
`binary-mods.php` is the main plugin file that:
- Always loads global modifications from `includes/global-mods.php`
- Conditionally loads site-specific modifications based on `get_site_url()` using a switch statement
- Supports three sites: frags.au, brinybits.au, and jetty.works

### Site-Specific Modules
Each site has its own PHP file in `includes/` that follows a consistent pattern:
- Custom login logo via `login_enqueue_scripts` hook with inline styles
- Site-specific stylesheet enqueuing via `wp_enqueue_scripts` hook with `PHP_INT_MAX` priority
- All stylesheets include cache-busting using `filemtime()`

**Supported Sites:**
- `frags.au` → `includes/frags.php` + `assets/frags-custom-styles.css` + `assets/frags-logo.png`
- `brinybits.au` → `includes/brinybits.php` + `assets/brinybits-custom-styles.css` + `assets/brinybits-logo.png`
- `jetty.works` → `includes/jettyworks.php` + `assets/jettyworks-custom-styles.css` + `assets/jettyworks-logo.png`

### Global Modifications
`includes/global-mods.php` applies to all sites and handles:
- Removing the login language dropdown
- Customizing login logo URL and title to point to the site
- Enqueuing global custom styles from `assets/binarymods-custom-styles.css`

### Asset Structure
The `assets/` directory contains:
- Site-specific CSS files (e.g., `frags-custom-styles.css`)
- Site-specific logo images (e.g., `frags-logo.png`)
- Global CSS file (`binarymods-custom-styles.css`)

## Adding a New Site

To add support for a new site:
1. Add a new case to the switch statement in `binary-mods.php:25-35`
2. Create a new PHP file in `includes/` with login logo and custom styles functions
3. Create corresponding CSS file and logo image in `assets/`
4. Follow the naming convention: `{sitename}.php`, `{sitename}-custom-styles.css`, `{sitename}-logo.png`

## WordPress Development

This is a standard WordPress plugin. Common WordPress development practices apply:
- Test in a WordPress environment (version 6.0+, PHP 8.0+)
- All files use `defined( 'ABSPATH' ) || exit;` security check
- Function names follow WordPress convention: `{site/module}_function_name()`
- Priority `PHP_INT_MAX` is used to ensure custom styles load last
