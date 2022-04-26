import React, { Component } from 'react';
import './Game.css';

class GameEvent extends Component {

    constructor (props){
        super(props);
        this.state = {
            speed: 1,
            position_road: 0
        }
    }

    componentDidMount(){
        this.intervalId = setInterval(this.run_game.bind(this), 40);
    }

    run_game = () => {
        this.setState({
            speed: 1,
            position_road: this.state.position_road + this.state.speed
        });
    }

    render() {
        return (
            <div>
                <div className="game_container" style={{
                    backgroundPosition: '0 ' + this.state.position_road + 'px'
                }}>
                    <div className="player"></div>
                </div>
            </div>
        );
    }
}

export default GameEvent;