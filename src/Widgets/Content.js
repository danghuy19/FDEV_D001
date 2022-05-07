import React, { Component } from 'react';
import LastestGame from '../Modules/LastestGame';
import ListGame from '../Modules/ListGame';
import Poster from '../Modules/Poster';
import Xbox from '../Modules/Xbox';
import Cart from '../Modules/Cart';
import FormCart from '../Modules/FormCart';


class Content extends Component {
    constructor(props) {
        super(props);
        this.state = {
            mang_gio_hang: []
        }
    }

    addToCart = (item) => {
        //console.log(item);
        let mang = this.state.mang_gio_hang;
        if(mang){
            let flag = 0;
            for(var i = 0; i < mang.length; i++){
                if(mang[i].id == item.id){
                    mang[i].quantity += 1;
                    flag = 1;
                }
            }
            if(flag == 0){
                item.quantity = 1;
                mang.push(item);
                
            }
        }
        else {
            item.quantity = 1;
            mang.push(item);
        }

        this.setState(prevState => {
            prevState.mang_gio_hang = mang;
            return prevState;
        })
    }

    DescreaseItemCart = (item) => {
        let mang = this.state.mang_gio_hang;
        for(var i = 0; i < mang.length; i++){
            if(mang[i].id == item.id){
                if(mang[i].quantity > 1){
                    mang[i].quantity -= 1;
                }
                else{
                    //do nothing
                }
            }
        }

        this.setState(prevState => {
            prevState.mang_gio_hang = mang;
            return prevState;
        })
    }

    render() {
        return (
            <div>
                <ListGame handleaddToCart={this.addToCart} />
                <FormCart CartItems={this.state.mang_gio_hang} 
                handleAddToCart={this.addToCart}
                handleDescreaseItemCart={this.DescreaseItemCart} />
                <LastestGame />
                <Poster />
                <Xbox />
                <Cart CartItems={this.state.mang_gio_hang}  />
                
            </div>
        );
    }
}

export default Content;