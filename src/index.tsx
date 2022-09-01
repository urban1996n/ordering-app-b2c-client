import * as React from 'react';
import ReactDOM from 'react-dom/client';
import {StrictMode} from 'react';

import { Xyz } from './components/xyz';

const root = ReactDOM.createRoot(
    document.getElementById('root') as HTMLElement
);

root.render(
    <StrictMode>
        <Xyz />
        <h1>Hello world hahahahahahhaha</h1>;
    </StrictMode>
)
