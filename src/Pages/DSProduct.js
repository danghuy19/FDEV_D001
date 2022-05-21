import React, { Component } from 'react';
const axios = require('axios').default;

class DSProduct extends Component {
    constructor(props) {
        super(props);
        this.state = {
            ds_sp: [],
            so_trang: 0,
            ten_sach: "",
            don_gia: 0,
            id: "",
            notice_message: ""
        };

        this.handleHideOrShowPopupEditProduct = this.handleHideOrShowPopupEditProduct.bind(this);

        this.buttonShowPopupEdit = React.createRef();
        this.buttonShowHidePopupNotice = React.createRef();
    }

    componentDidMount() {
        axios.get('http://localhost:4000/products?page=0')
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

    choseProductToEdit = (e) => {
        let info_item = JSON.parse(e.target.getAttribute('data-product'));
        //console.log(info_item);

        this.setState(prevState => {
            prevState.ten_sach = info_item.ten_sach;
            prevState.don_gia = info_item.don_gia;
            prevState.id = info_item.id;
            return prevState;
        })

        this.buttonShowPopupEdit.current.click();
    }

    handleChangeInput = (e) => {
        //console.log( e.target.name);
        this.setState(prevState => {
            prevState[e.target.name] = e.target.value;
            return prevState
        })
    }

    handleHideOrShowPopupEditProduct = (notice_message) => {
        this.setState(prevState => {
            prevState.notice_message = notice_message;
            return prevState;
        });
        this.buttonShowPopupEdit.current.click();
        setTimeout(() => {
            this.buttonShowHidePopupNotice.current.click();
        }, 200);
    }

    handleSubmitForm = (e) => {
        e.preventDefault();

        axios.put('http://localhost:4000/product', { ten_sach: this.state.ten_sach, don_gia: this.state.don_gia, id: this.state.id })
            .then((response) => {
                // handle success
                this.handleHideOrShowPopupEditProduct("Sửa sách mới thành công");

                let temp = this.state.ds_sp;
                for(var i = 0; i < temp.length; i++){
                    if(temp[i].id == this.state.id){
                        temp[i].ten_sach = this.state.ten_sach;
                        temp[i].don_gia = this.state.don_gia;
                    }
                }

                this.setState(prevState => {
                    prevState.ds_sp = temp;
                    return prevState;
                })

                console.log(response);
            })
            .catch((error) => {
                // handle error
                this.handleHideOrShowPopupEditProduct("Có lỗi xảy ra trong quá trình sửa");
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    }

    handleRemoveProduct = (e) => {
        let id_remove = e.target.getAttribute('data-id-delete');
        console.log(id_remove);
        axios.delete('http://localhost:4000/product?id=' + id_remove,)
            .then((response) => {
                // handle success
                

                let temp = this.state.ds_sp;
                for(var i = 0; i < temp.length; i++){
                    if(temp[i].id == this.state.id){
                        temp.splice(i, 1);
                    }
                }

                this.setState(prevState => {
                    prevState.ds_sp = temp;
                    return prevState;
                })

                console.log(response);

                alert('đã xoá thành công');

                
            })
            .catch((error) => {
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
                            return (<div style={{display:"flex"}} >{itemProduct.id} - {itemProduct.ten_sach} 
                                
                                <button type="button" class="btn btn-info" onClick={this.choseProductToEdit} data-product={JSON.stringify(itemProduct)} style={{width: '50px'}}>
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                </button>
                                
                                <button data-id-delete={itemProduct.id} onClick={this.handleRemoveProduct} type="button" class="btn btn-large btn-block btn-danger" style={{width: '50px'}}>
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                            </div>)
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

                
                <a class="btn btn-primary" ref={this.buttonShowPopupEdit} style={{display: "none"}} data-toggle="modal" href='#modal-edit'>Trigger modal</a>
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Sửa sách</h4>
                            </div>
                            <form onSubmit={this.handleSubmitForm}>
                                <div class="modal-body">
                                    
                                    <input type="hidden" value={this.state.id} name="id" />

                                    <div class="form-group">
                                        <label for="">Tên sách</label>
                                        <input type="text" onChange={this.handleChangeInput} value={this.state.ten_sach} name="ten_sach" class="form-control" id="" placeholder="Input field" />
                                    </div>

                                    <div class="form-group">
                                        <label for="">Đơn giá</label>
                                        <input type="text" onChange={this.handleChangeInput} value={this.state.don_gia} name="don_gia" class="form-control" id="" placeholder="Input field" />
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <a class="btn btn-primary" style={{display: "none"}} ref={this.buttonShowHidePopupNotice} data-toggle="modal" href='#modal-notice-edit'>Trigger modal</a>
                <div class="modal fade" id="modal-notice-edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Thông báo</h4>
                            </div>
                            <div class="modal-body">
                                {this.state.notice_message}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        );
    }
}

export default DSProduct;