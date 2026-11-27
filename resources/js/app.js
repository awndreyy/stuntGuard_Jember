// Font dan ikon disajikan lokal lewat Vite.
import '@fontsource-variable/plus-jakarta-sans';
import '@fontsource-variable/material-symbols-outlined/full.css';

import { createIcons, icons } from 'lucide';

window.lucide = {
    createIcons: () => createIcons({ icons }),
};

import './confirmation-modal';
