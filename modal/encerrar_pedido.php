<style>
        .rating-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .stars {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .star {
            font-size: 2rem;
            cursor: pointer;
            color: #ddd;
        }
        
        .star.selected {
            color: #f39c12;
        }
        
        .rating-value {
            margin-top: 20px;
            font-size: 1.2rem;
            color: #333;
        }
}
</style>
<div class="modal fade" id="encerramento" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-align-top-left" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Avalie o técnico</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="rating-container">
					<div class="stars">
						<span class="star" data-value="1">&#9733;</span>
						<span class="star" data-value="2">&#9733;</span>
						<span class="star" data-value="3">&#9733;</span>
						<span class="star" data-value="4">&#9733;</span>
						<span class="star" data-value="5">&#9733;</span>
					</div>
				<div class="rating-value" id="rating-value" style="display: none;">Insira sua nota</div>
			</div>
            </div>
			<form action="#" method="post">
            <div class="modal-footer">
                <button type="button" class="btn btn-lg m-b-15 ml-2 mr-2 btn-info" data-dismiss="modal">
                    Fechar
                </button>
					<input type="hidden" name="encerrar" id="encerrar" value="sim">
					<input type="hidden" name="nota" id="nota">
					<button type="submit" class="btn btn-lg m-b-15 ml-2 mr-2 btn-danger">Encerrar solicitação</button>				
            </div>
		</form>
        </div>
    </div>
</div>
<script>
// Simulação de valor vindo do banco de dados
        const initialRating = 0; // Este valor pode ser dinamicamente inserido pelo servidor

        document.addEventListener("DOMContentLoaded", function () {
            const stars = document.querySelectorAll(".star");
            const ratingValueElement = document.getElementById("rating-value");
            let selectedRating = initialRating;

            // Função para pintar estrelas
            function paintStars(rating) {
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.add("selected");
                    } else {
                        star.classList.remove("selected");
                    }
                });
                ratingValueElement.textContent = ` ${rating}`;
				
				document.getElementById('nota').value = ratingValueElement.textContent;
            }

            // Pintar estrelas com base no valor inicial
            paintStars(initialRating);

            stars.forEach((star, index) => {
                star.addEventListener("click", function () {
                    selectedRating = index + 1;
                    paintStars(selectedRating);
                });
            });
        });

</script>