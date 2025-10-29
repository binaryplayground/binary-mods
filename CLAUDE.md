# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

Binary Modifications is a WordPress plugin that provides shared customizations for the Binary Playground family of websites. It implements a multi-site architecture where global modifications apply to all sites, while site-specific modifications are loaded conditionally based on the domain.

## Architecture

### Plugin Entry Point
`binary-mods.php` is the main plugin file that:
- Always loads global modifications from `includes/global-mods.php`
- Auto-loads site-specific modifications based on the domain name
- Uses `wp_parse_url()` to extract the hostname and `strtok()` to get the first segment (before the first dot)
- Only loads site file if it exists (using `file_exists()` check)

**Auto-loading Convention:**
The plugin extracts the first segment of the hostname and looks for `includes/{segment}.php`:
- `frags.au` → `includes/frags.php`
- `brinybits.au` → `includes/brinybits.php`
- `jetty.works` → `includes/jetty.php`

### Site-Specific Modules
Each site has its own PHP file in `includes/` that follows a consistent pattern:
- Custom login logo via `login_enqueue_scripts` hook with inline styles
- Site-specific stylesheet enqueuing via `wp_enqueue_scripts` hook with `PHP_INT_MAX` priority
- All stylesheets include cache-busting using `filemtime()`

**Currently Supported Sites:**
- `frags.au` → `includes/frags.php` + `assets/frags-custom-styles.css` + `assets/frags-logo.png`
- `brinybits.au` → `includes/brinybits.php` + `assets/brinybits-custom-styles.css` + `assets/brinybits-logo.png`
- `jetty.works` → `includes/jetty.php` + `assets/jettyworks-custom-styles.css` + `assets/jettyworks-logo.png`

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

To add support for a new site, simply create the necessary files (no code changes to `binary-mods.php` required):

1. Create `includes/{first-segment-of-domain}.php` (e.g., for `example.com` create `includes/example.php`)
2. Add login logo and custom styles functions following the existing pattern
3. Create corresponding CSS file and logo image in `assets/` (can use any naming convention in assets, just reference correctly in the PHP file)

The plugin will automatically detect and load the file when running on that domain.

## WordPress Development

This is a standard WordPress plugin. Common WordPress development practices apply:
- Test in a WordPress environment (version 6.0+, PHP 8.0+)
- All files use `defined( 'ABSPATH' ) || exit;` security check
- Function names follow WordPress convention: `{site/module}_function_name()`
- Priority `PHP_INT_MAX` is used to ensure custom styles load last
