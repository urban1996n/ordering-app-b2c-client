import * as React from 'react';
import ReactDOM from 'react-dom/client';
import {StrictMode} from 'react';

import { Xyz } from './components/xyz';

const root = ReactDOM.createRoot(
    document.getElementById('root') as HTMLElement
);

const rootElement = document.getElementById('root');

if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    
    root.render(
        // Only for dev purposes
        <StrictMode>
            <Xyz />
            <h1>Hello world</h1>;
        </StrictMode>
    )
} else {
    throw Error("Something went wrong...");
}
