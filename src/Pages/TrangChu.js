import React, { Component } from 'react';

import LastestGame from '../Modules/LastestGame';
import ListGame from '../Modules/ListGame';
import Poster from '../Modules/Poster';
import Xbox from '../Modules/Xbox';

import { confirmAlert } from 'react-confirm-alert';

class TrangChu extends Component {

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

    RemoveItemCart = (item) => {

        const options = {
            title: 'Confirm',
            message: 'Bạn chắc chắn muốn xoá item này khỏi giỏ hàng hay không?',
            buttons: [
              {
                label: 'Yes',
                onClick: () => {
                    let mang = this.state.mang_gio_hang;

                    for(var i = 0; i < mang.length; i++){
                        if(mang[i].id == item.id){
                            mang.splice(i, 1);
                        }
                    }
            
                    //console.log(mang);
                    this.setState(prevState => {
                        prevState.mang_gio_hang = mang;
                        return prevState;
                    });
                }
              },
              {
                label: 'No',
                onClick: () => {
                    //do nothing
                }
              }
            ],
            childrenElement: () => <div />,
            closeOnEscape: true,
            closeOnClickOutside: true,
            keyCodeForClose: [8, 32],
            willUnmount: () => {},
            afterClose: () => {},
            onClickOutside: () => {},
            onKeypressEscape: () => {},
            overlayClassName: "overlay-custom-class-name"
        };
          
        confirmAlert(options);
        
    }

    render() {
        return (
            <div>
                <ListGame handleaddToCart={this.addToCart} />
                <LastestGame />
                <Poster />
                <Xbox />
                
            </div>
        );
    }
}

export default TrangChu;