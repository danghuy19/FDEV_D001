import React, { Component } from 'react';
import LastestGame from '../Modules/LastestGame';
import ListGame from '../Modules/ListGame';
import Poster from '../Modules/Poster';
import Xbox from '../Modules/Xbox';

class Content extends Component {
    render() {
        return (
            <div>
                <ListGame />
                <LastestGame />
                <Poster />
                <Xbox />
            </div>
        );
    }
}

export default Content;