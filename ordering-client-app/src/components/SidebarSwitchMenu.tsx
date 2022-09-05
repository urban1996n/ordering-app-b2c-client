import React from 'react';

import { Link } from 'react-router-dom';

export const DUMMY_MENU_TYPES = [
    {
        display: 'Starters',
        icon: '',
        to: '/',
        section: ''
    },
    {
        display: 'Seafood',
        icon: '',
        to: '/seafood',
        section: 'started'
    },
    {
        display: 'Specials',
        icon: '',
        to: '/specials',
        section: 'calendar'
    },
    {
        display: 'Main Dishes',
        icon: '',
        to: '/main_dishes',
        section: 'user'
    },
    {
        display: 'Desserts',
        icon: '',
        to: '/desserts',
        section: 'order'
    },
]

export const SidebarSwitchMenu = () => {
    return <>
        {DUMMY_MENU_TYPES.map((item, index) => (
            <Link key={index} to={item.to}>
                <p>{item.display}</p>
            </Link>
        ))}
    </>
}