import axios from 'axios';

export const likeReply = async (replyId) => {
    const {data} = await axios.post(`/replies/${replyId}/favorites`);
    return data;
}
