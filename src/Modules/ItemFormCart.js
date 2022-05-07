import React, { Component } from 'react';

class ItemFormCart extends Component {

    constructor(props){
        super(props);
    }

    handleaddToCartProcess = () => {
        //console.log(this.props.handleAddToCart);
        this.props.handleAddToCart(this.props.ItemCart);
    }

    handleDescreaseItemCartProcess = () => {
        this.props.handleDescreaseItemCart(this.props.ItemCart);
    }

    render() {
        return (
            <tr>
                <td>{this.props.ItemCart.id}</td>
                <td><img src={this.props.ItemCart.image} /></td>
                <td>{this.props.ItemCart.name}</td>
                <td>
                    <button type="button" onClick={this.handleDescreaseItemCartProcess} class="btn btn-default">-</button>
                    {this.props.ItemCart.quantity}
                    <button type="button" onClick={this.handleaddToCartProcess} class="btn btn-default">+</button>
                </td>
            </tr>
        );
    }
}

export default ItemFormCart;