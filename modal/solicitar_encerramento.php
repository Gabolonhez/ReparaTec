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
<div class="modal fade" id="solicitarEncerramento" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-align-top-left" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicite o encerramento</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
			<form action="#" method="post">
				<div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Motivo</span>
                </div>
                <textarea class="form-control" aria-label="With textarea" name="motivo" id="motivo"></textarea>
                </div>
				</label>
				<div style="margin-top: 30px;">
					<button type="button" class="btn btn-lg m-b-15 ml-2 mr-2 btn-info" data-dismiss="modal">
						Fechar
					</button>
					<input type="hidden" name="solicitar" id="solicitar" value="sim">
					<button type="submit" class="btn btn-lg m-b-15 ml-2 mr-2 btn-success">Solicitar</button>
				</div>
			</form>
			</div>
            </div>			
            <div class="modal-footer">				
				</div>
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