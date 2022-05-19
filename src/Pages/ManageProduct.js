import React, { Component } from 'react';
const axios = require('axios').default;

class ManageProduct extends Component {
    constructor(props) {
        super(props);
        this.state = {
            ten_sach: '',
            don_gia: ''
        }
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
                console.log(response);
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
        return (
            <div>

                <form onSubmit={this.handleSubmitForm}>
                    <legend>Thêm sản phẩm</legend>

                    <div class="form-group">
                        <label for="">Tên sách</label>
                        <input type="text" onChange={this.handleChangeInput} value={this.state.ten_sach} name="ten_sach" class="form-control" id="" placeholder="Input field" />
                    </div>

                    <div class="form-group">
                        <label for="">Đơn giá</label>
                        <input type="text" onChange={this.handleChangeInput} value={this.state.don_gia} name="don_gia" class="form-control" id="" placeholder="Input field" />
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        );
    }
}

export default ManageProduct;