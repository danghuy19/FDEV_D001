import React, { Component } from 'react';

class ShortGame extends Component {
    render() {
        return (
            <li>
                <div className="game-grid">
                    <h4>{this.props.game.typegame}</h4>
                    <p>{this.props.game.name}</p>
                    <img src={this.props.game.image} className="img-responsive" alt="" />
                </div>
            </li>
        );
    }
}

export default ShortGame;