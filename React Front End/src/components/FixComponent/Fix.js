import React, { Component } from "react";
import FixUnLogin from "./FixUnLogin";
import FixLogedin from "./FixLogedin";
import { Link } from "react-router-dom";
class Fix extends Component {
  constructor(props) {
    super(props);
    this.state = { names: "" };
    this.state = { ids: "" };
  }

  componentDidMount() {
    const name = localStorage.getItem("name");
    const id = localStorage.getItem("id");
    this.setState({ names: name });
    this.setState({ ids: id });
  }
  render() {
    return (
      <div className="container">
        {this.state.ids ? <FixLogedin /> : <FixUnLogin />}
      </div>
    );
  }
}

export default Fix;
