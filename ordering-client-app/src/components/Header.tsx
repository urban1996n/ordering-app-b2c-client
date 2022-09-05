import React from 'react';

export const Header = () => {
    const restaurantName = 'Restaurant';
    
    return <>
        <h1 className='d-inline-block mx-5'>{restaurantName}</h1>
        <button className='float-end mx-5'>Your order</button>
    </>
}