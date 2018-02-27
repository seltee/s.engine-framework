import React from 'react';
import ReactDOM from 'react-dom';

require("Less/loading.less");

export default class Loading extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            dots: "",
            interval: setInterval(function(){
                if (this.state.dots.length >= 3){
                    this.setState({dots: '.'});
                }else{
                    this.setState({dots: this.state.dots + '.'});
                }

            }.bind(this), 400)
        };
    }

    componentWillUnmount(){
        clearInterval(this.state.interval);
    }

    render(){
        return (
            <div className="loading">
                Loading {this.state.dots}
            </div>
        )
    }
};