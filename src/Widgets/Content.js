import React, { Component } from 'react';
import Cart from '../Modules/Cart';
import GioHang from '../Pages/GioHang';

import TrangChu from "../Pages/TrangChu";

import { Route, Routes } from 'react-router-dom'
import RandomGroup from '../Pages/RandomGroup';


class Content extends Component {

    constructor(props) {
        super(props);
        this.state = {
            mang_gio_hang: []
        }
    }

    

    render() {
        return (
            <div>
                <Routes>
                    <Route path="/" element={<TrangChu />} />
                    <Route path="/gio-hang" element={<GioHang />} />
                    <Route path="/random" element={<RandomGroup />} />
                </Routes>
                
                <Cart CartItems={this.state.mang_gio_hang}  />
            </div>
        );
    }
}

export default Content;