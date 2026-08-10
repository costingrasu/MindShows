# Plan: Revert `@font-face` Declarations in `style.css` to Match Original Styling

## Overview
Revert the `@font-face` declarations in `style.css` to match `old_style.css` character-for-character. This ensures titles use the custom ExtraBold font (`Brother-1816-ExtraBold.ttf`) under `'Brother 1816 Bold'`, while descriptions and body text using `'Brother 1816', 'Outfit', sans-serif` naturally fall back to regular `'Outfit'`, restoring the exact visual typography of the original theme.

---

## Admin/UI Tasks (For the Human)
**None.** Purely a stylesheet restoration step.

---

## Code Implementation Steps (For the Builder)

### File: `style.css`

Replace lines 8–45 in `style.css` with the exact original `@font-face` declarations from `old_style.css`:

```css
@font-face {
    font-family: 'Brother 1816 Bold';
    src: url('assets/fonts/Brother-1816-ExtraBold.ttf') format('truetype');
    font-weight: 800;
    font-style: normal;
    font-display: swap;
}

@font-face {
    font-family: 'Aerospace';
    src: url('assets/fonts/Aerospace.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

@font-face {
    font-family: 'Firlest';
    src: url('assets/fonts/Firlest-Regular.otf') format('opentype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

@font-face {
    font-family: 'Carnevalee Freakshow';
    src: url('assets/fonts/Carnevalee Freakshow.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

@font-face {
    font-family: 'Park Lane NF';
    src: url('assets/fonts/ParkLaneNF.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}
```

---

## Risks & Considerations
1. **Zero Visual Regressions:** Restores font rendering 100% back to `old_style.css` behavior.
2. **SEO Maintained:** Google Fonts (`Outfit` and `Inter`) remain enqueued via PHP preconnect in `functions.php`, preserving performance gains.
