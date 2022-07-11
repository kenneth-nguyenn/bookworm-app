import React, {Component} from 'react';
import {Col, Container, Image, Row} from "react-bootstrap";

class ProductPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: 0,
        }
    }

    render() {
        console.log(this.state.id)
        return (
            this.state.id ?
                <main>
                    <Container fluid>
                        <Row className={"border-bottom"}>
                            <h6 style={{"font-weight": "bold"}}>Category Name</h6>
                        </Row>
                        <Row>
                            <Row>
                                <Col className={"border"}>
                                    <Image src={""} alt={"book image"}/>
                                    <p>{this.props.id}</p>

                                </Col>
                                <Col>

                                </Col>
                            </Row>

                            <Row>

                            </Row>
                        </Row>
                    </Container>
                </main>
                : <main>Have no this book!</main>
        );
    }
}

export default ProductPage;


