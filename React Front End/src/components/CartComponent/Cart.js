import React, { Component } from "react";
import Cartdetail from "./Cartdetail";
import Main from "../MainComponent/Main";
class Cart extends Component {
  render() {
    const id = localStorage.getItem("id");
    return (
      <div className="col-12">{id !== "" ? <Cartdetail /> : <Main />}</div>
    );
  }
}

export default Cart;
