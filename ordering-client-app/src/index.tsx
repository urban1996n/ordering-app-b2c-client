import * as React from 'react';
import ReactDOM from 'react-dom/client';
import {StrictMode} from 'react';
import { App } from './components/App';
import 'bootstrap/dist/css/bootstrap.min.css';

const rootElement = document.getElementById('root');

if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);

    root.render(
        // Only for dev purposes
        <StrictMode>
            <App />
        </StrictMode>
    )
} else {
    throw Error("Something went wrong...");
}