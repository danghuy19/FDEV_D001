import React, { Component } from 'react';
import DSProduct from './DSProduct';
const axios = require('axios').default;

class ManageProduct extends Component {
    constructor(props) {
        super(props);
        this.state = {
            ten_sach: '',
            don_gia: '',
            notice_message: '',
            ShowNotice: false
        }

        this.handleHideOrShowPopupAddNew = this.handleHideOrShowPopupAddNew.bind(this);

        this.buttonShowHidePopupNotice = React.createRef();
        this.buttonShowHidePopupAddNew = React.createRef();
    }

    componentDidMount() {
        // this.buttonShowHidePopupNotice.current.click();
    }

    handleChangeInput = (e) => {
        //console.log( e.target.name);
        this.setState(prevState => {
            prevState[e.target.name] = e.target.value;
            return prevState
        })
    }

    handleSubmitForm = (e) => {
        e.preventDefault();
        console.log(this.state.ten_sach, this.state.don_gia);

        axios.post('http://localhost:4000/product', { ten_sach: this.state.ten_sach, don_gia: this.state.don_gia })
            .then((response) => {
                // handle success
                this.handleHideOrShowPopupAddNew("Thêm sách mới thành công");
                window.location.reload(false);
                console.log(response);
            })
            .catch((error) => {
                // handle error
                this.handleHideOrShowPopupAddNew("Có lỗi xảy ra trong quá trình thêm");
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    }

    handleHideOrShowPopupAddNew = (notice_message) => {
        this.setState(prevState => {
            prevState.notice_message = notice_message;
            return prevState;
        })
        this.buttonShowHidePopupAddNew.current.click();
        setTimeout(() => {
            this.buttonShowHidePopupNotice.current.click();
        }, 200);
    }

    handleClosePopupNotice = (e) => {
        this.setState(prevState => {
            prevState.notice_message = "";
            return prevState;
        })
    }

    render() {
        return (
            <div>

                
                <a ref={this.buttonShowHidePopupAddNew} class="btn btn-primary" data-toggle="modal" href='#modal-addnew'>Thêm sách mới</a>
                <div class="modal fade" id="modal-addnew">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Modal title</h4>
                            </div>
                            <form onSubmit={this.handleSubmitForm}>
                                <div class="modal-body">
                                    
                                    <legend>Thêm sản phẩm</legend>

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

                
                <a class="btn btn-primary" style={{display: "none"}} ref={this.buttonShowHidePopupNotice} data-toggle="modal" href='#modal-notice'>Trigger modal</a>
                <div class="modal fade" id="modal-notice">
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
                
                

                <DSProduct />

            </div>
        );
    }
}

export default ManageProduct;