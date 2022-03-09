import React, { useState } from 'react'
import { BrowserRouter, Route, Router, Routes } from 'react-router-dom';
import LayoutAllBooks from './LayoutAllBooks';
import UserMain from './UserMain';
import LibroIndv from './LibroIndv';

const Rutas = () => {

    const [userGlobal, setUserGlobal] = useState(false);

    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<LayoutAllBooks userGlobal={userGlobal}/>}>
                    <Route index element={<UserMain  userGlobal={userGlobal} setUserGlobal={setUserGlobal}/>} />
                    <Route path="libro/:id" element={<LibroIndv />} />
                </Route>
            </Routes>
        </BrowserRouter>
    )
}

export default Rutas