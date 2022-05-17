import React, { Component } from 'react';
const axios = require('axios').default;

class DSProduct extends Component {
    constructor(props) {
        super(props);
        this.state = {
            ds_sp: []
        };
    }

    componentDidMount() {
        axios.get('http://localhost:4000/products')
        .then( (response) => {
          // handle success
          //console.log(response);
          this.setState(prevState => {
            prevState.ds_sp = response.data;  
            return prevState;
          })
        })
        .catch( (error) => {
          // handle error
          console.log(error);
        })
        .then(function () {
          // always executed
        });
    }

    render() {
        return (
            <div>
                <div>
                Trang danh sách sản phẩm
                </div>
                <div>
                    {
                        this.state.ds_sp.map(itemProduct => {
                            return <div>{itemProduct.id} - {itemProduct.ten_sach}</div>
                        })
                    }
                </div>
            </div>
        );
    }
}

export default DSProduct;