import './bootstrap';
import '../css/app.css';
import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.tsx', { eager: true });
        const page = pages[`./Pages/${name}.tsx`];
        if (!page || typeof page !== 'object' || !('default' in page)) {
            throw new Error(`ページ './Pages/${name}.tsx' が見つからないか、正しくエクスポートされていません。`);
        }
        return (page as { default: React.ComponentType }).default;
    },
    setup({ el, App, props }) {
        createRoot(el as HTMLElement).render(<App {...props} />);
    },
});