import React from 'react';
import { Main } from './Main';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { DUMMY_MENU_TYPES } from './Menu/ScrollMenuNav';

export const App = () => {
    return <>
        <BrowserRouter>
            <Routes>
                <Route path='/' element={<Main />}>
                    {DUMMY_MENU_TYPES.map((type, index) => (
                        <Route 
                            key={index} 
                            path={type.to} 
                            element={<></>}
                        />
                    ))}
                </Route>
            </Routes>    
        </BrowserRouter>
    </>
}
