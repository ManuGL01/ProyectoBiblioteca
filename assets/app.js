/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// start the Stimulus application
//import '../bootstrap';

import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Router, Routes } from 'react-router-dom';
import LayoutAllBooks from './components/LayoutAllBooks';
import UserMain from './components/UserMain';
import LibroIndv from './components/LibroIndv';

ReactDOM.render(
    <>
    <BrowserRouter>
        <Routes>
            <Route path="/" element={<LayoutAllBooks/>}>
                <Route index element={<UserMain/>}/>
                <Route path=":id" element={<LibroIndv/>}/>
            </Route>
        </Routes>
    </BrowserRouter>

    </>
    , document.getElementById('mainIndex')
);

