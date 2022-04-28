import React, { Component } from 'react';

class RegisterForm extends Component {
    constructor(props){
        super(props);
        this.state = {
            email: '',
            password: '',
            re_password: '',
            fullname: '',
            phone: '',
            address: '',
            gender: 'Female'
        };
    }

    handleChangeInput = (e) => {
        //console.log( e.target.name);
        this.setState(prevState => {
            prevState[e.target.name] = e.target.value;
            return prevState
        })
    }

    render() {
        return (
            <div className="container">
                
                <form action="" method="POST" className="form-horizontal" role="form">
                        <div className="form-group">
                            <legend>Register Form</legend>
                        </div>

                        <div className="form-group">
                            <div className="col-sm-2">
                                Email
                            </div>
                            <div className="col-sm-10">
                                <input type="text" onChange={this.handleChangeInput} value={this.state.email} name="email" id="email" class="form-control" title="" />
                            </div>
                        </div>

                        <div className="form-group">
                            <div className="col-sm-2">
                                Password
                            </div>
                            <div className="col-sm-10">
                                <input type="password" onChange={this.handleChangeInput} value={this.state.password} name="password" id="password" class="form-control" title="" />
                            </div>
                        </div>

                        <div className="form-group">
                            <div className="col-sm-2">
                                Re-password
                            </div>
                            <div className="col-sm-10">
                                <input type="password" onChange={this.handleChangeInput} value={this.state.re_password} name="re_password" id="re_password" class="form-control" title="" />
                            </div>
                        </div>
                
                        <div className="form-group">
                            <div className="col-sm-2">
                                Full Name
                            </div>
                            <div className="col-sm-10">
                                <input type="text" onChange={this.handleChangeInput} value={this.state.fullname} name="fullname" id="fullname" class="form-control" title="" />
                            </div>
                        </div>

                        <div className="form-group">
                            <div className="col-sm-2">
                                Phone
                            </div>
                            <div className="col-sm-10">
                                <input type="text" onChange={this.handleChangeInput} value={this.state.phone} name="phone" id="phone" class="form-control" title="" />
                            </div>
                        </div>

                        <div className="form-group">
                            <div className="col-sm-2">
                                Address
                            </div>
                            <div className="col-sm-10">
                                <input type="text" onChange={this.handleChangeInput} value={this.state.address} name="address" id="address" class="form-control" title="" />
                            </div>
                        </div>

                        <div className="form-group">
                            <div className="col-sm-2">
                                Gender
                            </div>
                            <div className="col-sm-10">
                                <select name="gender" id="gender" onChange={this.handleChangeInput} value={this.state.gender} class="form-control" title="">
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        
                
                        <div className="form-group">
                            <div className="col-sm-10 col-sm-offset-2">
                                <button type="submit" className="btn btn-primary">Submit</button>
                            </div>
                        </div>
                </form>
                
            </div>
        );
    }
}

export default RegisterForm;