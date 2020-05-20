<table class="table table-bordered">
    <thead>
        @if($Mesomorph >= 0.5 && $Mesomorph <= 2.9)
            <tr>
                <th class="text-center">Bajo</th>
            </tr>
            <tr>
                <th class="text-center">0.5 - 2.9</th>
            </tr>
        @elseif($Mesomorph >= 3 && $Mesomorph < 5.5)
            <tr>
                <th class="text-center">Moderado</th>
            </tr>
            <tr>
                <th class="text-center">3 - 5.5</th>
            </tr>
        @elseif($Mesomorph >= 5.5 && $Mesomorph <= 7)
            <tr>
                <th class="text-center">Alto</th>
            </tr>
            <tr>
                <th class="text-center">5.5 - 7</th>
            </tr>
        @elseif($Mesomorph > 7)
            <tr>
                <th class="text-center">Muy Alto</th>
            </tr>
            <tr>
                <th class="text-center">> 7.5</th>
            </tr>
        @endif
    </thead>
    <tbody>
        <tr>
            @if($Mesomorph >= 0.5 && $Mesomorph <= 2.9)
                <td>
                    <p>Poca grasa subcutánea. Contornos musculares y oseos visibles.</p>
                </td>
            @elseif($Mesomorph >= 3 && $Mesomorph < 5.5)
                <td>
                    <p>Moderada adiposidad relativa. Apariencia más blanda.</p>
                </td>
            @elseif($Mesomorph >= 5.5 && $Mesomorph <= 7)
                <td>
                    <p>Alta adiposidad relativa. Grasa subcutánea abundante. Acumulación de grasa en el abdomen.</p>
                </td>
            @elseif($Mesomorph > 7)
                <td>
                    <p>Adiposidad relativa my alta. Clara acumulación de grasa subcutánea, especialmente en el abdomen.</p>
                </td>
            @endif
        </tr>
    </tbody>
</table>