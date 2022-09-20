import React from 'react';

export const Header = () => {
    const restaurantName = 'Restaurant';
    
    return <div>
        <h1 className='d-inline-block'>{restaurantName}</h1>
        <button className='float-end'>Your order</button>
    </div>
}
