import * as React from 'react';
import { ReactElement } from 'react';
import { render } from 'react-dom';

const App = (): ReactElement => (
    <>
        <h1>Hello world</h1>;
    </>
)

const mainDiv = document.querySelector('#main');

render(<App/>, mainDiv);