import React from 'react';
import ReactDOM from 'react-dom';

require("Less/news.less");

export default class App extends React.Component {
    render(){
        function formatDate(date) {
            function n(n){
                return n > 9 ? "" + n: "0" + n;
            }

            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();

            return n(day) + '.' + n(month) + '.' + year;
        }

        if (this.props.data) {
            var data = this.props.data;

            return (
                <div className="news-item">
                    <img src={data.PreviewImageLink}/>
                    <div>
                        <div>{data.Title}</div>
                        <div>{data.ShortBody}</div>
                        <div>{formatDate(new Date(data.Created))}</div>
                    </div>
                </div>
            )
        }else{
            return null;
        }
    }
};

ReactDOM.render(<App />, document.getElementById('app'));