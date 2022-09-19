import React, { Component } from "react";
import { Link } from "react-router-dom";
class Bookings extends Component {
  constructor(props) {
    super(props);
    this.state = { websites: [] };
    //this.state = {ids:''};
    this.headers = [{ key: "id", label: "รหัสการจอง ชื่อรุ่น สถานะ" }];
    this.deleteWebsite = this.deleteWebsite.bind(this);
  }
  valueId(e) {
    this.setState({ keyword: e.target.value });
    console.log("key2=" + e.target.value);
  }

  componentDidMount() {
    const id = localStorage.getItem("id");

    fetch(
      "https://www.api.senpru.com/signalinfo/index.php/booking/cus?cus=" + id
    )
      .then(response => {
        return response.json();
      })
      .then(result => {
        this.setState({
          websites: result
        });
      });
  }

  deleteWebsite(id) {
    if (window.confirm("ต้องการยกเลิกการจองใช่หรือไม่")) {
      fetch(
        "https://www.api.senpru.com/signalinfo/index.php/booking/delete_booking/" +
          id,
        {
          method: "DELETE" //,
          //mode: 'no-cors',
          /*headers : {
					'Access-Control-Allow-Origin': '*',
					'Content-Type' : 'text/plain'
				}*/
        }
      ).then(response => {
        if (response.status === 200) {
          alert("ยกเลิกการจองแล้วค่ะ");

          fetch(
            "https://www.api.senpru.com/signalinfo/index.php/booking/cus?cus=" +
              id
          )
            .then(response => {
              return response.json();
            })
            .then(result => {
              console.log(result);
              this.setState({
                websites: result
              });
            });
        }
      });
    }
  }

  render() {
    return (
      <div>
        <div className="container">
          <p />

          <table className="table table-borderless">
            <thead>
              <tr>
                {this.headers.map(function(h) {
                  return (
                    <th width="300px" key={h.key}>
                      {h.label}
                    </th>
                  );
                })}
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="myTable">
              {this.state.websites.map(
                function(item, key) {
                  return (
                    <tr key={key}>
                      {item.statusbook == "ยืนยันแล้ว" ? (
                        <tr>
                          <td>{item.id}</td>
                          <td>{item.name}</td>
                          <td>
                            {item.statusbook == "ยืนยันแล้ว" ? (
                              <b style={{ color: "#4caf50" }}>ยืนยันแล้ว</b>
                            ) : item.statusbook == "ไม่สามารถซ่อมได้" ? (
                              <b style={{ color: "#F11313" }}>
                                ไม่สามารถซ่อมได้
                              </b>
                            ) : (
                              <b style={{ color: "#ffc107" }}>รอการยืนยัน</b>
                            )}
                          </td>
                        </tr>
                      ) : (
                        <div></div>
                      )}
                      <td>
                        {item.statusbook == "ยืนยันแล้ว" ? (
                          <Link to={`/Bookdetail/${item.id}`}>
                            <button
                              btn-block
                              type="button"
                              class="btn btn-warning"
                              data-toggle="modal"
                              data-target=".bd-example-modal-xl"
                            >
                              รายละเอียด
                            </button>
                          </Link>
                        ) : (
                          <div></div>
                        )}
                        &nbsp;&nbsp;
                      </td>
                    </tr>
                  );
                }.bind(this)
              )}
            </tbody>
          </table>
        </div>
      </div>
    );
  }
}

export default Bookings;
