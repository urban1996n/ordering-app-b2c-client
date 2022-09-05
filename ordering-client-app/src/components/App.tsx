import React from 'react';
import { Main } from './Main';
import { SubMenu } from './SubMenu';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { DUMMY_MENU_TYPES } from './SidebarSwitchMenu';

export const App = () => {
    return <>
        <BrowserRouter>
            <Routes>
                <Route path='/' element={<Main />}>
                    {DUMMY_MENU_TYPES.map((type, index) => (
                        <Route 
                            key={index} 
                            path={type.to} 
                            element={<SubMenu />}
                        />
                    ))}
                </Route>
            </Routes>    
        </BrowserRouter>
    </>
}
