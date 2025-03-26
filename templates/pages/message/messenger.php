<main class="container">
    <section class="messenger">
        <div class="messenger__panel">
            <h1>Messagerie</h1>

            <div class="discussion active">
                <img src="/build/images/avatar/avatar.png" alt="Avatar de">
                <div class="discussion__detail">
                    <div class="discussion__detail--infos">
                        <p>Alexlecture</p>
                        <p class="date">15:43</p>
                    </div>
                    <p class="description">Lorem ipsum dolor sit amet,...</p>
                </div>
            </div>
        </div>

        <div class="messenger__discussion">
            <div class="messenger__discussion--head">
                <img src="/build/images/avatar/avatar.png" alt="Avatar de">
                <p>Alexlecture</p>
            </div>
            <div class="messenger__discussion--messages">
                <div class="message-to">
                    <p class="date">21.08 15:44</p>
                    <p class="message">
                        Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor
                    </p>
                </div>
                <div class="message-from">
                    <div class="infos">
                        <img src="/build/images/avatar/avatar.png" alt="Avatar de">
                        <p class="date">21.08 15:48</p>
                    </div>
                    <p class="message">
                        Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor
                    </p>
                </div>

            </div>
            <div class="messenger__discussion--sending">
                <form action="POST">
                    <div class="input_group">
                    <label for="content" class="sr-only">Message</label>
                    <input type="text" name="content" id="content" placeholder="Tapez votre message ici">
                    </div>
                    <input type="submit" name="send-message" id="send-message" class="btn" value="Envoyer">
                </form>
            </div>
        </div>
    </section>
</main>
