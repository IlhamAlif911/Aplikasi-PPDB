## Customizer Setting
 - saveLocal: - sessionStorage | localStorage | null & undefined & false
 - getLocal: - sessionStorage | localStorage | null & undefined & false
 - stateOptions - Object value

### stateOptions
##### theme setting (1)

1. 1. theme_scheme_direction: false | true (default: false) (type: radio)
2. 2. theme_scheme: 'light' | 'dark' | 'auto' (default: 'light') (type: radio)
3. 3. theme_style_appearance: 'default' | 'flat' | 'border' | 'sharp' (default: 'default') (type: checkbox)
4. 4. theme_color: [
        'primary' =>  'primary' | 'secondary' | 'success' | 'info' | 'warning' | 'danger' | 'light' | 'dark',
    ] (default: 'primary') (type: radio)
5. 5. theme_transition: true | false (default: 'true') (type: radio)
6. 6. theme_font_size: '14px' | '16px' | '18px' (default: '16px') (type: radio)

##### page layout (2)

7.  1. page_layout: 'boxed' | 'full' (default: 'full') (type: radio)

##### header (3)

8.  1. header_navbar: 'default' | 'fixed' | 'sticky' | 'glass' | 'colored' | 'transparent' | 'boxed' | 'hidden' (default: 'default') (type: radio)
9.  2. header_banner: 'default' | 'colored' (default: 'default') (type: radio)

##### sidebar (4)

10. 1. sidebar_color: 'default' | 'dark' | 'colored' | 'transparent' | (default: 'default') (type: radio)
11. 2. sidebar_type: ['default' | 'hover' | 'mini' | 'boxed'] (default: 'default') (type: checkbox , combination update)
12. 3. sidebar_menu_style: 'rounded' | 'rounded-all' | 'square' | 'square-all' | 'pill' | 'pill-all' (default: 'rounded-all') (type: radio)

##### footer (5)

13. 1. footer: 'default' | 'fixed' | 'sticky' |'transparent' (default: 'default') (type: radio)
