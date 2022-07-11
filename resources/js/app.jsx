import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router, Route, Routes,} from "react-router-dom";
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min';
import {Navigabar} from "./Navbar.js";
import {Footer} from "./Footer";
import Homepage from "./pages/Homepage";
import ShopPage from "./pages/ShopPage";
import ProductPage from "./pages/ProductPage";
import AboutPage from "./pages/AboutPage";

ReactDOM.render(
    <Router>
        <div>
            <Navigabar/>
            {/*<ShopPage/>*/}
            <Routes>
                <Route exact path="/" element={<Homepage/>}/>
                <Route exact path="/shop" element={<ShopPage/>}/>
                <Route exact path="/books/:id" element={<ProductPage/>}/>
                <Route exact path="/about" element={<AboutPage/>}/>
                {/*<Route path="/cart" element={}/>*/}
                {/*<Route path="/login" element={}/>*/}
                {/*<Route path="*" element={<NotFound/>}/>*/}
            </Routes>
            <Footer/>
        </div>
    </Router>,
    document.getElementById('root')
);








