import styles from './pagination.module.scss';

interface PaginationProps {
    meetupsPerPage: number;
    totalMeetups: number;
    paginate: (pageNumber: number) => void;
    currentPage: number;
}

const Pagination = ({ meetupsPerPage, totalMeetups, paginate, currentPage }: PaginationProps) => {
    const pageNumbers = [];
    const totalPages = Math.ceil(totalMeetups / meetupsPerPage);

    for (let i = 1; i <= totalPages; i++) {
        pageNumbers.push(i);
    }

    return (
        <nav className={styles.pagination}>
            <ul className={styles.paginationList}>
                <li>
                    <button
                        onClick={() => paginate(currentPage - 1)}
                        disabled={currentPage === 1}
                        className={`${styles.pageItem} ${currentPage === 1 ? styles.disabled : ''}`}
                    >
                        &#10094;
                    </button>
                </li>
                {pageNumbers.map(number => (
                    <li key={number} className={`${styles.pageItem} ${currentPage === number ? styles.active : ''}`}>
                        <button onClick={() => paginate(number)}>
                            {number}
                        </button>
                    </li>
                ))}
                <li>
                    <button
                        onClick={() => paginate(currentPage + 1)}
                        disabled={currentPage === totalPages}
                        className={`${styles.pageItem} ${currentPage === totalPages ? styles.disabled : ''}`}
                    >
                        &#10095;
                    </button>
                </li>
            </ul>
        </nav>
    );
};

export default Pagination;
