import "../../styles/routes/form.scss";
import React, {useState} from "react";
import {useNavigate} from "react-router";
import {apiClient} from "../../api/apiClient.jsx";

export const FormStoreBookPage = () => {
    const [validationErrors, setValidationErrors] = useState({});
    const [error, setError] = useState('');
    const [fileValidationErrors, setFileValidationErrors] = useState({});
    const [fileError, setFileError] = useState('');
    const [title, setTitle] = useState('');
    const [type, setType] = useState('');
    const [booksListStatus, setStatus] = useState('');
    const [description, setDescription] = useState('');
    const [countPages, setCountPages] = useState('');
    const [author, setAuthor] = useState('');
    const [publishingDate, setPublishingDate] = useState('');
    const [rating, setRating] = useState('');
    const [note, setNote] = useState('');
    const [cover, setCover] = useState('');
    const [coverId, setCoverId] = useState('');

    const navigate = useNavigate();

    const handleFormStoreBook = async (e) => {
        e.preventDefault();

        try {
            const response = await apiClient.post('/api/books',
                {
                    title,
                    cover_id: coverId,
                    type,
                    books_list_status: booksListStatus,
                    description,
                    count_pages: countPages,
                    author,
                    publishing_date: publishingDate,
                    rating,
                    note
                }, {});
            navigate(-1); //TODO ВОЗВРАТ НА ПРОШЛУЮ СТРАНИЦУ ИЛИ переход на страницу книги?
        } catch (error) {
            if (error.status === 403) {
                window.location = '/login';
            }
            if (error.response && error.response.status === 422) {
                setValidationErrors(error.response.data.errors);
            } else {
                setError(error.response?.data?.errors || 'Произошла ошибка! Попробуйте позже');
            }
        }
    };

    const saveAttachment = async (e) => {
        setFileError('');
        setFileValidationErrors({});
        try {
            const formData = new FormData();
            formData.append('file', e.target.files[0]);
            formData.append('group', 'cover');
            formData.append('model', 'Book');
            setCover(e.target.value);

            const response = await apiClient.post('/api/file', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });

            setCoverId(response.data);
        } catch (error) {
            if (error.status === 403) {
                window.location = '/login';
            }
            if (error.response && error.response.status === 422) {
                setFileValidationErrors(error.response.data.errors);
            } else {
                setFileError(error.response?.data?.errors || 'Не получилось загрузить файл');
            }
        }
    };

    return (
        <div className="main-form">
            <div className="form">
                <div className="form-title">Добавьте новую книгу</div>
                <form onSubmit={handleFormStoreBook}>
                    <div className="field">
                        {validationErrors.title && validationErrors.title.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <input
                            type="text"
                            name="title"
                            id="title"
                            placeholder="Название" required
                            value={title}
                            onChange={(e) => setTitle(e.target.value)}
                        />
                    </div>
                    <div className="field">
                        {validationErrors.type && validationErrors.type.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <select name="type" id="book-type-select" value={type} required
                                onChange={(e) => setType(e.target.value)}>
                            <option value="">Выберите тип</option>
                            <option value="1">Книга</option>
                            <option value="2">Журнал</option>
                            <option value="3">Комикс</option>
                            <option value="4">Манга</option>
                        </select>

                    </div>
                    <div className="field">
                        {validationErrors.books_list_status && validationErrors.books_list_status.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <select name="books_list_status" id="books-list-status-select" value={booksListStatus} required
                                onChange={(e) => setStatus(e.target.value)}>
                            <option value="">Выберите статус</option>
                            <option value="1">Запланировано</option>
                            <option value="2">Читаю</option>
                            <option value="3">Перечитываю</option>
                            <option value="4">Прочитано</option>
                            <option value="5">Отложено</option>
                            <option value="6">Брошено</option>
                        </select>
                    </div>
                    <div className="field">
                        {validationErrors.description && validationErrors.description.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <textarea
                            name="description"
                            id="description"
                            placeholder="Описание"
                            value={description}
                            rows="4"
                            onChange={(e) => setDescription(e.target.value)}
                        />
                    </div>
                    <div className="field">
                        {validationErrors.count_pages && validationErrors.count_pages.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <input
                            type="int"
                            name="count_pages"
                            id="count-pages"
                            min="1"
                            placeholder="Количество страниц"
                            value={countPages}
                            onChange={(e) => setCountPages(e.target.value)}
                        />
                    </div>
                    <div className="field">
                        {validationErrors.author && validationErrors.author.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <input
                            type="text"
                            name="author"
                            id="author"
                            placeholder="Автор"
                            value={author}
                            onChange={(e) => setAuthor(e.target.value)}
                        />
                    </div>
                    <div className="field">
                        {validationErrors.publishing_date && validationErrors.publishing_date.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <input
                            type="date"
                            name="publishing_date"
                            id="publishing-date"
                            placeholder="Дата выхода"
                            value={publishingDate}
                            onChange={(e) => setPublishingDate(e.target.value)}
                        />
                    </div>
                    <div className="field">
                        {validationErrors.rating && validationErrors.rating.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <select name="rating" id="rating-select" value={rating}
                                onChange={(e) => setRating(e.target.value)}>
                            <option value="">Выберите оценку</option>
                            <option value="1">(1) Хуже некуда</option>
                            <option value="2">(2) Ужасно</option>
                            <option value="3">(3) Очень плохо</option>
                            <option value="4">(4) Плохо</option>
                            <option value="5">(5) Более-менее</option>
                            <option value="6">(6) Нормально</option>
                            <option value="7">(7) Хорошо</option>
                            <option value="8">(8) Отлично</option>
                            <option value="9">(9) Великолепно</option>
                            <option value="10">(10) Просто восторг!</option>
                        </select>
                    </div>
                    <div className="field">
                        {validationErrors.note && validationErrors.note.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <textarea
                            name="note"
                            id="note"
                            placeholder="Заметка"
                            rows="4"
                            value={note}
                            onChange={(e) => setNote(e.target.value)}
                        />
                    </div>
                    <div className="field">
                        {validationErrors.cover_id && validationErrors.cover_id.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <div className="input-file">
                            <input
                                type="file"
                                name="cover"
                                id="cover"
                                value={cover}
                                className='file-input-hidden'
                                onChange={(e) => saveAttachment(e)}
                            />
                            <label htmlFor="cover" className="upload-label">
                                Выбрать обложку
                            </label>
                            <span className="file-name-text">{cover || 'Файл не выбран'}</span>
                            <br/>
                        </div>
                        <div className="hint">Макс.размер файла - 90 МБ</div>
                        <div className="error">
                            {fileValidationErrors.file && fileValidationErrors.file.map((msg, index) => (
                                <p className="error" key={index}>{msg}</p>
                            ))}
                            {fileError && <p className="error">{fileError}</p>}
                        </div>
                    </div>
                    <div className="submit">
                        <button type="submit">Сохранить</button>
                    </div>
                    <div className="error">
                        {error && <p className="error">{error}</p>}
                    </div>
                </form>
            </div>
        </div>
    );
};
