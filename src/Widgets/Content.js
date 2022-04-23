import React, { Component } from 'react';

class Content extends Component {
    render() {
        return (
            <div>
                <div className="content">
                    <div className="container">
                        <div className="top-games">
                            <h3>Top Games</h3>
                            <span></span>
                        </div>
                        <div className="top-game-grids">
                            <ul id="flexiselDemo1">
                                <li>
                                    <div className="game-grid">
                                        <h4>Action Games</h4>
                                        <p>Nulla elementum nunc tempus.</p>
                                        <img src="images/t1.jpg" className="img-responsive" alt="" />
                                    </div>
                                </li>
                                <li>
                                    <div className="game-grid">
                                        <h4>Racing Games</h4>
                                        <p>Nulla elementum nunc tempus.</p>
                                        <img src="images/t3.jpg" className="img-responsive" alt="" />
                                    </div>
                                </li>
                                <li>
                                    <div className="game-grid">
                                        <h4>3D Games</h4>
                                        <p>Nulla elementum nunc tempus.</p>
                                        <img src="images/t4.jpg" className="img-responsive" alt="" />
                                    </div>
                                </li>
                                <li>
                                    <div className="game-grid">
                                        <h4>Arcade Games</h4>
                                        <p>Nulla elementum nunc tempus.</p>
                                        <img src="images/t2.jpg" className="img-responsive" alt="" />
                                    </div>
                                </li>
                            </ul>


                        </div>
                    </div>
                </div>
                <div className="latest">
                    <div className="container">
                        <div className="latest-games">
                            <h3>Latest Games</h3>
                            <span></span>
                        </div>
                        <div className="latest-top">
                            <div className="col-md-5 trailer-text">
                                <div className="sub-trailer">
                                    <div className="col-md-4 sub-img">
                                        <img src="images/v2.jpg" alt="img07" />
                                    </div>
                                    <div className="col-md-8 sub-text">
                                        <a href="#">Killzone: Shadow Fall for PlayStation 4 Reviews</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipi…</p>
                                    </div>
                                    <div className="clearfix"> </div>
                                </div>
                                <div className="sub-trailer">
                                    <div className="col-md-4 sub-img">
                                        <img src="images/v1.jpg" alt="img07" />
                                    </div>
                                    <div className="col-md-8 sub-text">
                                        <a href="#"> Spiderman 2 Full Version PC Game</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipi…</p>
                                    </div>
                                    <div className="clearfix"> </div>
                                </div>
                                <div className="sub-trailer">
                                    <div className="col-md-4 sub-img">
                                        <img src="images/v3.jpg" alt="img07" />
                                    </div>
                                    <div className="col-md-8 sub-text">
                                        <a href="#">Sega's: Jet Set for Andriod Play Store 4 Reviews</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipi…</p>
                                    </div>
                                    <div className="clearfix"> </div>
                                </div>
                            </div>
                            <div className="col-md-7 trailer">
                                <iframe src="https://www.youtube.com/embed/V5-DyoVlNOg?list=PLiVunv1pnIs2c0ORVqY60K3n8XMO9CoGp" frameborder="0" allowfullscreen></iframe>
                            </div>
                            <div className="clearfix"> </div>
                        </div>
                    </div>
                </div>
                <div className="poster">
                    <div className="container">
                        <div className="poster-info">
                            <h3>Nunc cursus dui in metus efficitur, sit amet ullamcorper dolor viverra.</h3>
                            <p>Proin ornare metus eros, quis mattis lorem venenatis eget. Curabitur eget dui euismod,
                            varius nisl eu, pharetra lacus. Sed vehicula tempor leo. Aenean dictum suscipit magna vel
            tempus. Aliquam nec dui dolor. Quisque scelerisque aliquet est et dignissim. Morbi magna quam, molestie sed fermentum et, elementum at dolor</p>
                            <a className="hvr-bounce-to-bottom" href="reviews.html">Read More</a>
                        </div>
                    </div>
                </div>
                <div className="x-box">
                    <div className="container">
                        <div className="x-box_sec">
                            <div className="col-md-7 x-box-left">
                                <h2>XBOX 360</h2>
                                <h3>Suspendisse ornare nisl et tellus convallis, non vehicula nibh convallis.</h3>
                                <p>Proin ornare metus eros, quis mattis lorem venenatis eget. Curabitur eget dui
                                euismod, varius nisl eu, pharetra lacus. Sed vehicula tempor leo. Aenean dictum suscipit magna vel tempus.
              Aliquam nec dui dolor. Quisque scelerisque aliquet est et dignissim.</p>
                                <a className="hvr-bounce-to-top" href="reviews.html">Read More</a>
                            </div>
                            <div className="col-md-5 x-box-right">
                                <img src="images/xbox.jpg" className="img-responsive" alt="" />
                            </div>
                            <div className="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        );
    }
}

export default Content;