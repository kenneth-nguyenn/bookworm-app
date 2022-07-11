import {Pagination} from "react-bootstrap";
import {Component} from "react";

export default class Paginater extends Component {
    constructor(props) {
        super(props);

    }

    render() {
        const [total, current, onChangePage] = [this.props.total, this.props.current, this.props.onChangePage]
        const items = []

        if (current > 1) {
            items.push(<Pagination.Prev key={'prev'} onClick={() => this.props.onChangePage(current - 1)}/>)
        }

        for (let page = 1; page <= total; page++) {
            items.push(
                <Pagination.Item
                    activeLabel
                    key={page}
                    data-page={page}
                    active={page === current}
                    onClick={() => this.props.onChangePage(page)}>
                    {page}
                </Pagination.Item>
            )
        }

        if (current < total) {
            items.push(<Pagination.Next
                key={"next"}
                onClick={() => this.props.onChangePage(current + 1)}
            />)
        }

        return (
            <>
                <Pagination className={"justify-content-md-center m-0 my-2"}>{items}</Pagination>
            </>
        );
    }
}
