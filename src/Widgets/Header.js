import React, { Component } from 'react';

class Header extends Component {
    constructor(props) {
        super(props);
        this.state = {
            search_value: ""
        }
    }

    handleChangeValueSearch = (e) => {
        //console.log(e.target.value);
        this.setState({
            search_value: e.target.value
        });
    }

    handleSubmitSearchForm = (e) => {
        e.preventDefault();
        //console.log('test');
        window.location.href = window.location.href + "?s=" + this.state.search_value;
    }

    render() {
        return (
            <div>
                <div className="top-banner">
                    <div className="header">
                        <div className="container">
                            <div className="headr-left">
                                <div className="social">
                                    <a href="#"><i className="facebook"></i></a>
                                    <a href="#"><i className="twitter"></i></a>
                                    <a href="#"><i className="gplus"></i></a>
                                    <a href="#"><i className="pin"></i></a>
                                    <a href="#"><i className="youtube"></i></a>
                                </div>
                                <div className="search">
                                    <form onSubmit={this.handleSubmitSearchForm}>
                                        <input type="submit" value="" />
                                        <input type="text" value={this.state.search_value} onChange={this.handleChangeValueSearch} placeholder="Search..." />
                                    </form>
                                </div>
                                <div className="clearfix"></div>
                            </div>
                            <div className="headr-right">
                                <div className="details">
                                    <ul>
                                        <li><a href="mailto@example.com"><span className="glyphicon glyphicon-envelope" aria-hidden="true"></span>info(at)example.com</a></li>
                                        <li><span className="glyphicon glyphicon-earphone" aria-hidden="true"></span>(+1)000 123 456789</li>
                                    </ul>
                                </div>
                            </div>
                            <div className="clearfix"></div>
                        </div>
                    </div>
                    <div className="banner-info">
                        <div className="container">
                            <div className="logo">
                                <h1><a href="index.html">GAME BOX</a></h1>
                            </div>
                            <div className="top-menu">
                                <span className="menu"></span>
                                <ul className="nav1">
                                    <li className="active"><a href="index.html">Home</a></li>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="reviews.html">Reviews</a></li>
                                    <li><a href="typo.html">News</a></li>
                                    <li><a href="gallery.html">Gallery</a></li>
                                    <li><a href="contact.html">Mail</a></li>
                                </ul>
                            </div>


                            <div className="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div className="slider">
                    <div className="callbacks_container">
                        <ul className="rslides" id="slider">

                            <div className="slid banner1">
                                <div className="caption">
                                    <h3>Donec id diam nec ex luctus congue nec sed mi.</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec pellentesque ex. Morbi iaculis mi in varius auctor. Nullam feugiat erat ex, eu vehicula velit efficitur non.</p>
                                </div>
                            </div>


                            <div className="slid banner2">
                                <div className="caption">
                                    <h3>Pellentesque eu ante quis elit interdum cursus.</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec pellentesque ex. Morbi iaculis mi in varius auctor. Nullam feugiat erat ex, eu vehicula velit efficitur non.</p>
                                </div>
                            </div>


                            <div className="slid banner3">
                                <div className="caption">
                                    <h3>Fusce id urna ut felis feugiat fringilla sed quis nisl.</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec pellentesque ex. Morbi iaculis mi in varius auctor. Nullam feugiat erat ex, eu vehicula velit efficitur non.</p>
                                </div>
                            </div>

                        </ul>
                    </div>
                </div>


            </div>
        );
    }
}

export default Header;