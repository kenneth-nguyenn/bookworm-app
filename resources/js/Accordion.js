import React from "react";
import {Col, Container, Form} from "react-bootstrap";

class AccordionOne extends React.Component {
    constructor(props) {
        super(props);
    }

    handleChange = (event) => {
        console.log(event.target.value)
    }

    handleCollege = (event) => {

    }

    render() {
        return (
            <>
                <Container>
                    <Form.Group as={Col} controlId="formGridState">
                        <Form.Label onClick={this.handleCollege}>{this.props.dataFill.title}</Form.Label>
                        <Form.Control onClick={this.handleChange} as="checkbox" defaultValue="Choose">
                            {this.props.dataFill.ranges.map((option) => <option
                                value={option.value}>{option.name}</option>)}
                        </Form.Control>
                    </Form.Group>
                </Container>
            </>
        );
    }
}

export default AccordionOne;
