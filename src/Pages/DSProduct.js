import React, { Component } from 'react';
const axios = require('axios').default;

class DSProduct extends Component {
    constructor(props) {
        super(props);
        this.state = {
            ds_sp: [],
            so_trang: 0
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

        axios.get('http://localhost:4000/products/total-page')
        .then( (response) => {
            // handle success
            //console.log(response);
            this.setState(prevState => {
                prevState.so_trang = response.data.so_trang;
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

    handleChangePage = (e) => {
        //console.log(e.target.getAttribute('data-page'));
        let page_chose = e.target.getAttribute('data-page');
        axios.get('http://localhost:4000/products?page=' + page_chose)
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
        let ds_trang = [];
        for(let i = 0; i < this.state.so_trang; i++){
            ds_trang.push(i);
        }

        return (
            <div>
                <div>
                Trang danh sách sản phẩm
                {this.state.so_trang}
                </div>
                <div>
                    {
                        this.state.ds_sp.map(itemProduct => {
                            return <div>{itemProduct.id} - {itemProduct.ten_sach}</div>
                        })
                    }
                </div>
                <div className="phan_trang">
                    <button type="button" class="btn btn-primary">first</button>
                    <button type="button" class="btn btn-primary">prev</button>
                    <div className="ds_trang">
                        {
                            ds_trang.map(item_trang => {
                                return <button type="button" onClick={this.handleChangePage} data-page={item_trang} class="btn btn-primary">{item_trang + 1}</button>
                            })
                        }
                    </div>
                    <button type="button" class="btn btn-primary">next</button>
                    <button type="button" class="btn btn-primary">last</button>
                </div>
            </div>
        );
    }
}

export default DSProduct;