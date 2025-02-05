<main>
    <div class="container">
        <div class="breadcrumbs">
            <a href="#" class="icon">
                <i class="fa-solid fa-arrow-left"></i>
                Retour
            </a>
        </div>

        <section class="add_book">
            <h1><?= $title ?></h1>
            <form method="POST">
                <div class="form_group">
                    <div class="input_group">
                        <label for="cover">Photo</label>
                        <input type="file" id="cover" name="cover" accept="image/png, image/jpeg"/>
                    </div>
                </div>

                <div class="form_group">
                    <div class="input_group">
                        <label for="title">Titre</label>
                        <input type="text" id="title" name="title" value="The Kinkfolk Table"/>
                    </div>
                    <div class="input_group">
                        <label for="author">Auteur•ice</label>
                        <input type="text" id="author" name="author" value="Nathan Williams"/>
                    </div>
                    <div class="input_group">
                        <label for="description">Commentaire</label>
                        <textarea id="description" name="description" rows="20">
J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. 'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.
                    </textarea>
                    </div>
                    <div class="input_group">
                        <label for="state">Disponibilité</label>
                        <select id="state" name="state">
                            <option value="0">Disponible</option>
                            <option value="1">Indisponible</option>
                        </select>
                    </div>
                    <button type="submit" id="submit" name="submit" class="btn">Valider</button>
                </div>
            </form>
        </section>
    </div>
</main>
