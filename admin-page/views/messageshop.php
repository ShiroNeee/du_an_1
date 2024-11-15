<style>
    .chat-container {
        width: 1200px;
        height: 600px;
        background-color: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        display: flex;
        flex-direction: column;margin-left: 30px;
    }
    .header {
        background-color: #3c91e6;
        color: #fff;
        padding: 15px;
        text-align: center;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 16px;
    }
    .header :hover {
        background-color: #357ab8;
    }
    .header .back-arrow {
        cursor: pointer;
    }
    .chat-box {
        padding: 10px;
        flex: 1;
        overflow-y: auto;
    }
    .message {
        display: flex;
        flex-direction: column;
        max-width: 50%;
        margin-bottom: 10px;
        border-radius: 10px;
        padding: 10px;
        font-size: 15px;
        line-height: 1.4;
        position: relative;
    }

    .sent {
        background-color: #e1f5fe;
        align-self: flex-end;
        text-align: left;
    }
    .received {
        margin-left: 600px;
        background-color: #f1f0f0;
        align-self: flex-start;
        text-align: left;
    }
    .timestamp {
        font-size: 12px;
        color: #aaa;
        margin-top: 5px;
    }
    .timestamp.sent {
        align-self: flex-end;
    }
    .timestamp.received {
        align-self: flex-start;
    }
    .input-box {
        display: flex;
        padding: 10px;
        border-top: 1px solid #ddd;
    }
    .input-box input {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 20px;
        background-color: #f0f0f0;
        margin-right: 10px;
        font-size: 14px;
    }
    .input-box button {
        background-color: #3c91e6;
        color: white;
        border: none;
        border-radius: 50%;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 14px;
    }
    .input-box button:hover {
        background-color: #357ab8;
    }
</style>
<div class="chat-container">
    <div class="header">
        <a href="../admin-page/"><span class="back-arrow">←</span></a>
        <span class="user-name">Nhóm Unique Style - Trò Chuyện (Message)</span>
    </div>
    <div class="chat-box">
        <div class="message received">
            <p>Chào buổi sáng mọi người trong nhóm, nhóm mình hiện tại dự án đang triển khai đến đâu r, có vấn đề gì không?? </p>
            <span class="timestamp">6:05 AM</span>
        </div>
        <div class="message sent">
            <p style="color:lightblue">Thành viên 1</p>
            <p>chào buổi sáng, tôi vừa mới ngủ dậy, à dự án bây giờ đang rất phát triển nên sẽ kh vấn đề gì đâu ông</p>
            <span class="timestamp">6:10 AM</span>
        </div>
        <div class="message sent">
            <p style="color:lightblue">Thành viên 2</p>
            <p>Đúng r đấy ông, không vấn đề j !!</p>
            <span class="timestamp">6:11 AM</span>
        </div>
        <div class="message received">
            <p>Ok thế thì tốt rồi, tí mọi người làm dự án đi nhé </p>
            <span class="timestamp">6:15 AM</span>
        </div>
        <div class="message sent">
            <p style="color:lightblue">Thành viên 3</p>
            <p>Ok let go </p>
            <span class="timestamp">6:20 AM</span>
        </div>
        <div class="message sent">
            <p style="color:lightblue">Thành viên 3</p>
            <p>:)) </p>
            <span class="timestamp">6:20 AM</span>
        </div>
        <div class="message sent">
            <p style="color:lightblue">Thành viên 3</p>
            <p>:)) </p>
            <span class="timestamp">6:20 AM</span>
        </div>
        <div class="message sent">
            <p style="color:lightblue">Thành viên 3</p>
            <p>:)) </p>
            <span class="timestamp">6:20 AM</span>
        </div>
        <div class="message sent">
            <p style="color:lightblue">Thành viên 3</p>
            <p>:)) </p>
            <span class="timestamp">6:21 AM</span>
        </div>
    </div>
    <div class="input-box">
        <input type="text" placeholder="Nhập tin nhắn..." name="message">
        <a href="?act=messageshop"><button type="submit">Gửi</button></a>
    </div>
</div>